<html>
	<body>
		<div id="myvue">
			<h1> {{ message }} </h1>

			<input v-model="message"/>
		</div>	
	</body>

	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.min.js"></script>
	<script>
		new Vue({
			el: '#myvue',
			data: {
				message: 'Hello Ruph'
			}
		});
	</script>

</html>