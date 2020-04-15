<template>
 <div>
    <vs-col vs-lg="12">
      <vs-card>
        <div slot="header">
          <div >
            <div class="pull-left">
            <h4>Produtos</h4>
            </div>
            <div class="float-right">
            <vs-button type="gradient" @click="novoRegistro">Adicionar</vs-button>
            </div>  
          </div>
    <b-modal
      id="modal-prevent-closing-modify"
      ref="modal"
      title="Preencha os campos"
      hide-footer
    >
	<b-form @submit="onSubmit" @reset="onReset">
      <b-form-group
        id="input-group-1"
        label="Nome:"
        label-for="input-1"
      >
      <input class="form-control-modify"
          id="input-1"
          v-model="form.name_product"
          required
          placeholder="Digite o nome do produto"
        >
      </b-form-group>

      <b-form-group id="input-group-2" label="Quantidade:" label-for="input-2">
        <input class="form-control-modify"
          id="input-2"
          type="number"
          v-model="form.quantity"
          required
          placeholder="Digite a quantidade"
        >
      </b-form-group>

      <b-form-group id="input-group-3" label="Preço Unitário:" label-for="input-3">
        <money 
        class="form-control-modify"
        id="input-3"
        v-model="form.price_unit" 
        v-bind="money"
        required
        placeholder="Digite o preço unitário"></money>
      </b-form-group>

      <b-button type="submit" variant="primary" size="lg" style="float: right; margin-top: 30px">Confirmar</b-button>
    </b-form>
    </b-modal>

        </div>
        <TopProducts/>
      </vs-card>
    </vs-col>
</div>  
</template>

<script>
import TopProducts from './components/dashboard/TopProducts.vue';
import Barramento from '@/plugins/barramento.js'

/* eslint-disable */
export default {
	name: 'StarterPage',
  components: {
    TopProducts,
  },
    data() {
      return {
          id: null,
          money: {
            decimal: ',',
            thousands: '.',
            prefix: 'R$ ',
            suffix: '',
            precision: 2,
            masked: false
        },
        	form: {
          		name_product: '',
          		quantity: '',
          		price_unit	: ''
        	}
      }
    },
    methods: {
		onSubmit(evt) {
			evt.preventDefault()
      var metodo = this.id ? 'patch' : 'post'
			var finalUrl = this.id ? `/${this.id}` : ''

			this.$http[metodo](`products${finalUrl}`, this.form)
			.then(resp => {
          this.obterUsuarios()
          this.$bvModal.hide('modal-prevent-closing-modify')
          this.$swal(
						'Sucesso',
						'Cadastrado com sucesso!',
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
		onReset() {
        this.id = null
        this.form.name_product = ''
        this.form.quantity = ''
        this.form.price_unit =  ''
      },
        obterUsuarios(){
        this.$http.get('products').then(resp =>{
        this.$store.state.products = []
        this.$store.state.products.push(resp.data.data)
      })
    },
    novoRegistro(){
      this.onReset()
      this.$bvModal.show('modal-prevent-closing-modify')
      }
    },
  mounted(){
    this.obterUsuarios()
  },
  created(){
        Barramento.$on('editarUsuario', (id)=>{
          this.id = id
          this.form = {...this.$store.state.products[0].find(product => product.id === id)}
          this.$bvModal.show('modal-prevent-closing-modify')
        })
    }
}
</script>
<style scoped>
.form-control-modify {
    display: block;
    width: 100%;
    height: calc(1.45em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.45;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
</style>
