<template>
<div class="table-responsive" style="margin-top:5%;">    
<table class="table v-middle border">
    <thead>
        <tr class="">
            <th class="border-top-0">Licença</th>
            <th class="border-top-0">Suporte</th>
            <th class="border-top-0">Tecnologia</th>
            <th class="border-top-0">Tickets</th>
            <th class="border-top-0">Vendas</th>
            <th class="border-top-0">Ganhos</th>
            <th class="border-top-0">Ações</th>
            
        </tr>
    </thead>
    <tbody>
        <template v-for="produto in $store.state.products" >
        <tr v-for="prod in produto" :key="prod.id">
            <td>{{prod.license}}</td>
            <td>{{prod.support}}</td>
            <td>
                <label class="label label-danger">{{prod.technology}}</label>
            </td>
            <td>{{prod.tickets}}</td>
            <td>{{prod.sales}}</td>
            <td>
                <h5 class="m-b-0">R$ {{formatPrice(prod.earnings)}}</h5>
            </td>
            <td>
                <div class="row">
                    <vs-button color="warning" @click="carregar(prod.id)" type="gradient">Editar</vs-button>
                    <vs-button color="danger" class="ml-2" @click="excluir(prod.id)" type="gradient">Excluir</vs-button>
                </div>
            </td>
        </tr>
         </template>

    </tbody>
</table>
</div>
</template>
<script>
import Barramento from '@/plugins/barramento.js'

/* eslint-disable */ 
export default {
    name: "TopProducts",
    methods:{
    excluir(id){
			this.$http.delete(`products/${id}`)
			.then(resp => {
                this.obterUsuarios()
                this.$swal(
						'Sucesso',
						'Deletado com sucesso!',
						'success'
                        )
			})
			.catch(err => {
                this.$swal({
						icon: 'error',
						title: 'Oops...',
						text: 'Ocorreu um erro!'
                        })
			})
    },
    carregar(id){
            Barramento.$emit('editarUsuario', id)
		},
    obterUsuarios(){
        this.$http.get('products').then(resp =>{
        this.$store.state.products = []
        this.$store.state.products.push(resp.data.data)
      })
    },
        formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
  }
}
</script>