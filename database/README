
# Summary of Back-End Database Development: Macdonald

This section of the project outlines the design, creation, and population of the complete relational database used throughout our padel e-commerce website. The database forms the backbone of the application, supporting products, categories, customers, orders, stock management, and more.

I was responsible for building the entire cs2team18_db schema, implementing all relationships, and preparing production-ready product data for use by the rest of the development team.


# Database Schema (implemented using MySQL)

The database was designed from scratch to provide a structured, scalable and maintainable foundation for the website.
It consists of all core tables required for an e-commerce platform, including:

Users & Roles: users, roles, user_roles, addresses

Product System: products, categories, product_variants, product_variant_attributes, padel_attributes

Shopping & Orders: carts, cart_items, orders, order_items

Inventory Management: stock_levels, stock_ledger, restock_orders, restock_items, inventory_alerts

Customer Features: reviews, contact_requests, enquiries, returns, return_items

Supporting Structures: timestamp fields, UUID primary keys, soft-activation flags, and foreign-key relationships

The final schema is fully relational, well-normalised, and designed so front-end and back-end components can reliably query and update data.

# Product & Category Population 

To ensure a realistic shopping experience during development, I created and inserted a full range of detailed catalogue data, including:

The entire category hierarchy
(Padel Rackets, Balls, Bags, Sportswear, Coaching, T-Shirts, Shoes, etc.)

Professional product descriptions 

Clean, SEO-friendly slugs for consistent routing

Accurate pricing, product URLs, and structured metadata

Duplicate-slug resolution and validation of missing fields

Correct category-to-product relationships for accurate filtering

This allowed the front-end team to work with real product listings rather than placeholders.


# Image & Asset Integration

To prepare products for display, I introduced a consistent image-handling approach:

Matching image filenames with product slugs

Adding real product images where available

Assigning a default fallback image (Babolat-Air-Vertuo-Padel-Racket-2025.png) for products without photography

Organising the repository into /images/products/... so developers can easily locate and reference media

This ensures the website displays product imagery reliably across all pages.

# Overall Contribution

My main contribution was delivering a complete, production-quality database layer, including:

Full schema creation

Table structuring and relationship design

Complete product-catalogue population

Image path systems and naming standards

Extensive debugging and data refinement

This enabled the rest of the team to build authentication, basket features, product listings, and order processing on top of a stable and realistic back-end foundation.
