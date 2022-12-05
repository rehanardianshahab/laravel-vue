<!DOCTYPE html>
<html>
<head>
	<title>Event Handling</title>
    <style>
        .example {
            border: 1px solid black;
            border-radius: 20px;
            padding: 20px;
            margin: 30px;
        }
    </style>
</head>
<body>
	<div id="example-1" class="example">
	  <button v-on:click="counter += 1">Add 1</button>
	  <p>The button above has been clicked {{ counter }} times.</p>
	</div>

	<div id="example-2" class="example">
	  <!-- `greet` is the name of a method defined below -->
	  <button v-on:click="greet">Greet</button>
	</div> 

	<div id="example-3" class="example">
	  <button v-on:click="say('hi')">Say hi</button>
	  <button v-on:click="say('what')">Say what</button>
	  
      

	  <span id="example-3_1">
	    <button v-on:click="warn('Form cannot be submitted yet.', $event)">Submit</button>
      </span>
    </div> 
    
    

	<div id="example-4" class="example">
	 <button v-on:click.once="greet">Greet Once</button>
	</div> 

	<div id="app" class="example">
		<label>Nama: </label>
		<input type="text" @keyup.enter='pesan' placeholder="tekan enter">
	</div> 

	<div id="app1" class="example">
		<label>Nama: </label>
		<input type="text" @keyup.shift.enter='myListener' placeholder="tekan shift+enter">
	</div>

	<div id="editor" class="example">
	  <textarea rows="15" :value="input" 
        @click.right="logme('ini right')"  
        @click.left="logme('ini left')" placeholder="klik kanan atau kiri">
      </textarea>
	</div>


</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script type="text/javascript">
	//listening to events
	var example1 = new Vue({
	  el: '#example-1',
	  data: {
	    counter: 0
	  }
	})


	//Method Event Handlers
	var example2 = new Vue({
	  el: '#example-2',
	  data: {
	    name: 'Vue.js'
	  },
	  // define methods under the `methods` object
	  methods: {
	    greet: function (event) {
	      // `this` inside methods points to the Vue instance
	      alert('Hello ' + this.name + '!')
	      // `event` is the native DOM event
	      if (event) {
	        alert(event.target.tagName)
	      }
	    }
	  }
	})


	//Methods in Inline Handlers
	new Vue({
	  el: '#example-3',
	  methods: {
	    say: function (message) {
	      alert(message)
	    }
	  }
	})

	new Vue({
	  el: '#example-3_1',
	  methods: {
		  warn: function (message, event) {
		    // sekarang kita memiliki akses ke event bawaan
		    if (event) event.preventDefault()
		    alert(message)
		  }
		}
	})


	//Event Modifiers
	var example4 = new Vue({
	  el: '#example-4',
	  data: {
	    name: 'Vue.js'
	  },
	  // define methods under the `methods` object
	  methods: {
	    greet: function (event) {
	      // `this` inside methods points to the Vue instance
	      alert('Hello ' + this.name + '!')
	    }
	  }
	})


	//Key Modifiers
	var app = new Vue({
			el: '#app',
			methods: {
				pesan: function () {
					alert('Anda menekan tombol Enter')
				}
			}
		})


	//System Modifier Keys
	var app = new Vue({
			el: '#app1',
			methods: {
				myListener: function () {
					alert('Anda menekan tombol shift + enter!')
				}
			}
		})

	//Mouse Button Modifier
	new Vue({
	  el: '#editor',
	  data: {
	    input: ''
	  },
	  methods: {
	    logme (msg) {
				this.input += msg +'\n'
	    }
	  }
	})

</script>