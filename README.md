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

    -   [ ] Manage Profile
    -   [ ] Manage Delivery Address
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

-   id (reused as buyer_id)
-   name
-   email
-   password
-   address
-   phone
-   type: [buyer, seller, both, default: buyer]
-   role: [user, admin, default: user]
-   seller_id \*
-   created_at
-   updated_at

-   shop_id
-   shop_name

### Products
