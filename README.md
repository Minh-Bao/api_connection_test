## Ar24 test

- Ce projet a été fait avec Laravel version 10  via Inertia (VueJs3/Tailwindcss) et quelques packages pour le front . 
- La version PHP est la 8.2.5   

- Le projet est sous docker à l'aide de l'interface laravel 'sail', j'ai supprimé les images inutiles pour le projet


### Installation du projet

- Cloner le projet   

```bash
git clone https://github.com/Minh-Bao/api_connection_test
```

- Lancer le projet sous docker 

```bash
sail up -d
```

- Installer les dependances composer  

```bash
sail composer install
```

- Installer les dependances npm

```bash
sail npm install
```

- Puis lancer les migrations pour la bdd

```bash
sail php artisan migrate:fresh
```

- Puis build les asset npm ou bien dev pour modifier en direct les fichier vuejs  

```bash
sail npm run build
sail npm run dev
```

### Informations diverses
- Se rendre à l'adresse http://test_ar24-laravel.test-1.localhost pour visiter le site  
- Le projet et le fichier composer.json sont set à php8.2 

 








