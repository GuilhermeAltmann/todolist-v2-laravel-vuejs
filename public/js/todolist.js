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

      this.$http.get('/lists').then(response => {

        // get body data
        this.lists = response.body

      }, response => {
        // error callback
      })

      this.$http.get('/cards').then(response => {

        // get body data
        this.cards = response.body

      }, response => {
        // error callback
      })
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
        this.card = index;
        this.cardA = index;
      },
      transferItem: function(){

        item = this.item

        this.lists[this.cardA].itens.splice(this.indexItem, 1);
        this.lists[this.card].itens.push(item)
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