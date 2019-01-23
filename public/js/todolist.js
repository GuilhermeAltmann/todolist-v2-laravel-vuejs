var vm = new Vue({
    el: '#todo',
    data: {
      lists: [{
        title: "Titulo",
        itens:[{
          id:1,
          description: "oi"
        },
        {id:1,
        description: "teste"
      }]
      }]
    },
    computed: {
      
    },
    methods: {
      add: function(){

        this.lists.push({title: "",
          itens:[{
            id:-1,
            description: ""
          }]
        })
      }
    },
})