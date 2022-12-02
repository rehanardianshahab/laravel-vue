<!DOCTYPE html>
<html>
<head>
	<title>Basic Componenet</title>
</head>
<body>
	<div id="app" v-if="status == 'tampilkan' ">
	  {{ message }} <br><br>
	  <label v-for="user in users">Nama : {{ user.name }}, Umur : {{user.age}}<br></label>
	</div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script type="text/javascript">
	var app = new Vue({
	  el: '#app',
	  data: {
	    message: 'Hello Vue!',
	    status: 'tampilkan',
	    users: [
	    	{
	    		name : 'Batman',
	    		age : '21'
	    	},
	    	{
	    		name : 'Superman',
	    		age : '22'
	    	},
	    	{
	    		name : 'Spiderman',
	    		age : '23'
	    	}
	    ]
	  }
	});
</script>