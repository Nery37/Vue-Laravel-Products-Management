<template lang="html">

   <div id="parentx">
    <vs-sidebar default-index="1" :parent="parent" :hiddenBackground="doNotClose" color="primary" class="sidebarx" spacer v-model="isSidebarActive" :click-not-close="doNotClose" >
        <div class="header-sidebar text-center" slot="header">
            <vs-avatar size="70px" src="https://media-exp1.licdn.com/dms/image/C4D03AQGfYpI6qi6o8w/profile-displayphoto-shrink_200_200/0?e=1592438400&v=beta&t=tCn4BDryLVXCydRwsug10wUlUrhDeAmspqB8d7BRzRI"/>
            <h4>Vinicius Nery<br/>
              <small>Viniciusneryb13@hotmail.com</small>
            </h4>
        </div>
        <template v-for="(sidebarLink, index) in sidebarLinks" >
            <vs-sidebar-item :icon="sidebarLink.icon" :to="sidebarLink.url" :key="`sidebarLink-${index}`" :index="index">
              <span class="hide-in-minisidebar">{{ sidebarLink.name }}</span>
            </vs-sidebar-item>
        </template>  
        
        <div class="footer-sidebar" slot="footer">
        </div>

    </vs-sidebar>
  </div>


</template>

<script>

export default {
  name: "SideBar",
  props: {
    parent: {
        type: String
    },
    sidebarLinks: {
      type: Array,
      required: true,
    },
    index: {
        default: null,
        type: [String, Number]
    }
  },
  data:()=>({
    doNotClose: false,
    windowWidth: window.innerWidth,
  }),
  computed: {
      //This is for mobile trigger
      isSidebarActive: {
        get() {
          return this.$store.state.isSidebarActive
        },
        set(val) {
          this.$store.commit('IS_SIDEBAR_ACTIVE', val)
        }
      }
   },
   watch: {
      
   },   
   methods : {
      handleWindowResize(event) {
            this.windowWidth = event.currentTarget.innerWidth;
            this.setSidebar();
        },
      setSidebar() {
        if (this.windowWidth < 1170) {
          this.$store.commit('IS_SIDEBAR_ACTIVE', false);
          this.doNotClose= false
        } 
        else {
          this.$store.commit('IS_SIDEBAR_ACTIVE', true);
          this.doNotClose= true 
        }
      }
  },
  mounted() {
      this.$nextTick(() => {
            window.addEventListener('resize', this.handleWindowResize);
        });
      this.setSidebar();
    },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleWindowResize);
    this.setSidebar();
  }
}
</script>