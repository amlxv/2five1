# 2five1 - Coding Matrix E-Commerce Project

## Modules

-   Public Page

    -   [ ] Landing
    -   [ ] About
    -   [ ] Contact
    -   [ ] Others (Please add to the checklist)

-   Authentication

    -   [x] Sign Up
    -   [x] Sign In
    -   [x] Reset Password
    -   [x] Email Verification
    -   [ ] Others (Please add to the checklist)

-   Users

    -   [ ] Buyer Dashboard
    -   [ ] Seller Dashboard
    -   [ ] Settings
    -   [ ] Others (Please add to the checklist)

-   Buyer Dashboard

    -   [x] Manage Profile
    -   [x] Manage Delivery Address
    -   [ ] Purchase History
    -   [ ] Others (Please add to the checklist)

-   Seller Dashboard

    -   [ ] Manage Profile
    -   [ ] Manage Product
    -   [ ] Product History
    -   [ ] Others (Please add to the checklist)

-   Product

    -   [ ] Add Product
    -   [ ] Update Product
    -   [ ] Remove Product

-   Marketplace

    -   [ ] Product List
    -   [ ] Top Product
    -   [ ] Top Seller
    -   [ ] Others (Please add to the checklist)

-   Admin
    -   [ ] Manage Users
    -   [ ] Manage Product
    -   [ ] Manage Website
    -   [ ] Others (Please add to the checklist)

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
-   avatar
-   type: [buyer, seller, both, default: buyer]
-   role: [user, admin, default: user]
-   shop_name
-   shop_avatar
-   updated_at
-   created_at

### Products
