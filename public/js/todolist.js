Vue.http.interceptors.push(function(request) {

  // modify headers
  request.headers.set('X-CSRF-TOKEN', document.getElementById("csrf-token").getAttribute('content'));
});

var vm = new Vue({
    el: '#todo',
    data: {
      item: "",
      indexItem: "",
      card: "",
      cardA: "",
      cards: [],
      lists: [],
      timer: 800
    },
    computed: {
      
    },
    mounted: function(){

      _ = this.cards

      cards = []

      this.$http.get('/lists').then(response => {

        // get body data
        this.lists = response.body

      }, response => {
        // error callback
      })

      this.$http.get('/cards').then(response => {

        // get body data
        response.body.forEach(function(item, index){

          cards.push({id: item.id, title: item.title})

        })

      }, response => {
        // error callback
      })

      _.cards = cards;
    },
    watch: {
      lists:{
        handler: function (val, oldVal) {

          _ = this

          _.cards = []

          val.forEach(function(item, index){

            _.cards.push({id: item.id, title: item.title})
          })
        },
        deep: true
      }
    },
    methods: {
      addCard: function(){

        this.lists.push({
          id:-1,
          title: "",
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

        id = this.lists[index].itens[indexItem].id;

        if(id != -1){

          this.$http.delete('/itens/' + id).then(response => {

          }, response => {
            // error callback
          })
        }
        this.lists[index].itens.splice(indexItem, 1);
        
      },
      removeCard: function(index){
        
        id = this.lists[index].id;

        if(id != -1){

          this.$http.delete('/lists/' + id).then(response => {

          }, response => {
            // error callback
          })
        }

        this.lists.splice(index, 1);
      },
      openModalTitle: function(index, indexItem){

        this.item = this.lists[index].itens[indexItem];
        this.indexItem = indexItem;
        this.card = this.lists[index].id;
        this.cardA = index;
      },
      transferItem: function(){

        item = this.item
        id = this.lists[this.cardA].itens[this.indexItem].id;

        this.$http.delete('/itens/' + id).then(response => {

        }, response => {
          // error callback
        })

        item.id = -1

        this.$http.post('/itens/' + this.card, item).then(response => {

          // get body data
          this.lists[this.cardA].itens[this.indexItem].id = response.body;
        }, response => {
          // error callback
        })

        this.$http.get('/lists').then(response => {

          // get body data
          this.lists = response.body
  
        }, response => {
          // error callback
        })
        

      },

      saveCard: function(list, index){

        if (this.timer) {
          clearTimeout(this.timer);
          this.timer = null;
        }

        this.timer = setTimeout(() => {

          this.$http.post('/lists', list).then(response => {

            // get body data
            this.lists[index].id = response.body;
    
          }, response => {
            // error callback
          })
        }, 800);
        
      },
      saveItem: function(item, index, cardId, indexItem){


        if (this.timer) {
          clearTimeout(this.timer);
          this.timer = null;
        }

        this.timer = setTimeout(() => {
          this.$http.post('/itens/' + cardId, item).then(response => {

            // get body data
            this.lists[index].itens[indexItem].id = response.body;
    
          }, response => {
            // error callback
          })
        }, 800);
      }
    },
})