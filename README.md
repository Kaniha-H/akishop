# Akishop

Test pour Four Data

Fonctionnalités :

- accès au dashboard admin avec la possibilité de :

  - création, lecture, édition et suppression d'un produit réservé seulement aux utilisateurs qui possèdent le role admin
  - création, lecture, édition et suppression d'une catégorie réservé seulement aux utilisateurs qui possèdent le role admin
  - création, lecture, édition et suppression d'une sous-catégorie réservé seulement aux utilisateurs qui possèdent le role admin

- visualiser un produit en détails
- ajouter, supprimer, changer la quantité du produit dans le panier
- possibilité de payer avec Stripe
- voir ses commandes seulement quand l'utilisateur est connecté

<img src="https://github.com/Kaniha-H/akishop/blob/main/assets/img/aki-home.png" />

Vue de la liste des produits :

<img src="https://github.com/Kaniha-H/akishop/blob/main/assets/img/list-products.png" />

Vue de la création d'un produit :

<img src="https://github.com/Kaniha-H/akishop/blob/main/assets/img/ajout-product.png" />

Vue de l'édition d'un produit :

<img src="https://github.com/Kaniha-H/akishop/blob/main/assets/img/edit-product.png" />

### Commande pour la création d'un admin :

```
  symfony console app:create-admin [nom-de-utilisateur] [mail] [mot-de-passe]
```

### Le site a besoin d'une clé d'api de Stripe pour fonctionner

Une clé public et une clé secrète
