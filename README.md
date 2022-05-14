# 2five1 - Coding Matrix E-Commerce Project

## Modules

-   Authentication

    -   [x] Sign Up
    -   [x] Sign In
    -   [x] Reset Password
    -   [x] Email Verification

-   Users

    -   [x] Buyer Dashboard
    -   [x] Seller Dashboard
    -   [x] Settings

-   Buyer Dashboard

    -   [x] Manage Profile
    -   [x] Manage Delivery Address
    -   [x] Purchase History

-   Seller Dashboard

    -   [x] Manage Profile
    -   [x] Manage Product

-   Product

    -   [x] Add Product
    -   [x] Update Product
    -   [x] Remove Product

-   Marketplace

    -   [x] Product List

-   Admin

    -   [x] Manage Users
    -   [x] Manage Categories

## Notes

### Users

-   Two roles; admin & users
-   Two type of users; buyer & seller
-   Both seller & buyer are users
-   Initial user type will be set to buyer
-   They can apply to be a seller after register
-   So, they'll be in the same table

### Product

-   No limit on product
-   Currency in MYR; prefixed with RM
-   Product have their own category
-   New category cannot be created without admin previleges

## DB Sketch (\* NULLABLE)

### Users

-   id
-   name
-   email
-   password
-   address
-   phone
-   avatar \*
-   type: [buyer, both, default: buyer] \*
-   role: [user, admin, default: user]
-   shop_name \*
-   shop_avatar \*
-   updated_at
-   created_at

### Products

-   id
-   name
-   description
-   quantity
-   price
-   image
-   category
-   sku \*
-   seller_id
-   status (active/inactive)
-   created_at
-   updated_at

### Categories

-   id
-   name
-   image
-   description
-   status (active/inactive)
-   created_at
-   updated_at

### Purchases

-   id
-   buyer_id
-   product_id
-   order_id
-   transaction_id
-   total_price
-   billcode
-   status (pending/completed/failed)
-   created_at
-   updated_at
