up-app:
	docker build -t lemp_stack .
	docker run -d -p 1337:80 --name t_lemp_stack lemp_stack
	