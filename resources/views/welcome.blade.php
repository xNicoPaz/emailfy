<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" value="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

	<!--Bibliotecas-->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
<div id="app">
	<div class="container">
		<div class="row">
			<h1>Cliente para envio de correo</h1>
		</div>
		<div class="row">
			<div class="col-12 form-group">
				<input type="email" class="form-control" placeholder="De " name="from" v-model="email.from">
			</div>
		</div>
		<div class="row">
			<div class="col-12 form-group">
				<input type="email" class="form-control" placeholder="Para " name="to" v-model="email.to">
			</div>
		</div>
		<div class="row">
			<div class="col-12 form-group">
				<input type="text" class="form-control" placeholder="Asunto " name="subject" v-model="email.subject">
			</div>
		</div>
		<div class="row">
			<div class="col-12 form-group">
				<textarea name="body" cols="30" rows="10" class="form-control" placeholder="Cuerpo del email" v-model="email.body"></textarea>
			</div>
		</div>
		<div class="row">
			<button id="sendEmailBtn" class="btn btn-primary pull-right" @click="sendEmailBtnClick">Enviar email</button>
		</div>
	</div>
</div>
<script>
	window.Vue.debug = true;
	window.Vue.devTools = true;
	
	let app = new Vue({
		el: '#app',
		data: {
			email: {
				from: '',
				to: '',
				subject: '',
				body: '',				
			}
		},
		created(){
			//Axios y el tema del CSRF token
			window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
			let token = document.head.querySelector('meta[name="csrf-token"]');
			if (token) {
				window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
			}else{
				console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
			}				
		},
		methods: {
			sendEmailBtnClick(){
				window.axios.post('/email', { 
					from: this.email.from,
					to: this.email.to,
					subject: this.email.subject,
					body: this.email.body
				});					
			},
		}
	});
</script>
</body>
</html>
