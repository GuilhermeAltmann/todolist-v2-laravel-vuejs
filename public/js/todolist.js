var vm = new Vue({
    el: '#todo',
    data: {
      item: "",
      indexItem: "",
      card: "",
      cardA: "",
      cards: ["Titulo"],
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
    watch: {
      lists:{
        handler: function (val, oldVal) {

          _ = this

          val.forEach(function(item, index){
            _.cards[index] = item.title
          })
        },
        deep: true
      }
    },
    methods: {
      addCard: function(){

        this.lists.push({title: "",
          itens:[{
            id:-1,
            description: ""
          }]
        })
      },
      addItem: function(index){

        this.lists[index].itens.push({
          id:-1,
          description: ""
        })
      },
      removeItem: function(index, indexItem){

        this.lists[index].itens.splice(indexItem, 1);
        
      },
      removeCard: function(index){
        
        this.lists.splice(index, 1);
      },
      openModalTitle: function(index, indexItem){

        this.item = this.lists[index].itens[indexItem];
        this.indexItem = indexItem;
        this.card = index;
        this.cardA = index;
      },
      transferItem: function(){

        item = this.item

        this.lists[this.cardA].itens.splice(this.indexItem, 1);
        this.lists[this.card].itens.push(item)
      }
    },
})