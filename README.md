# Backend Summary – Order Processing & Integration

This backend handles all order processing, cart management, product retrieval, and authentication integration for the Vibora UK e-commerce system.

---

## Authentication (Provided by Anesh)

### Endpoints

| Method | Endpoint             | Description                                |
| ------ | -------------------- | ------------------------------------------ |
| POST   | `/api/auth/register` | Register a new user                        |
| POST   | `/api/auth/login`    | Log in and receive a JWT token             |
| GET    | `/api/auth/profile`  | Retrieve user information (requires token) |

**Technologies Used**

- JWT authentication
- Bcrypt password hashing

---

## Cart System (Ahmed Feature)

Handles adding items, updating quantities, and displaying basket contents.

### Endpoints

| Method | Endpoint                       | Description                                                         |
| ------ | ------------------------------ | ------------------------------------------------------------------- |
| GET    | `/api/cart/:userId`            | Retrieve the user's active cart and its items                       |
| POST   | `/api/cart/add`                | Add a product to the cart (automatically creates a cart if missing) |
| PATCH  | `/api/cart/update/:cartItemId` | Update item quantity                                                |
| DELETE | `/api/cart/remove/:cartItemId` | Remove a cart item                                                  |

### Key Features

- Automatically creates a cart using UUID
- Recalculates pricing on updates
- Supports dynamic product pricing and product data

---

## Orders (Ahmed Feature)

Handles checkout, order creation, price totals, and order history.

### Endpoints

| Method | Endpoint                      | Description                           |
| ------ | ----------------------------- | ------------------------------------- |
| POST   | `/api/orders/checkout`        | Creates an order from the user’s cart |
| GET    | `/api/orders/history/:userId` | Returns all past orders for a user    |

### Checkout Logic Includes

- Subtotal calculation
- New customer discount (10%)
- VAT (20%)
- Grand total calculation
- Moves cart items into `order_items`
- Clears the cart after checkout

---

## Products API (Used by Frontend)

### Endpoints

| Method | Endpoint            | Description                                                |
| ------ | ------------------- | ---------------------------------------------------------- |
| GET    | `/api/products`     | Retrieve all products (optional category filter supported) |
| GET    | `/api/products/:id` | Retrieve details for a single product                      |

---

## Completed Requirements

- Order placement implemented
- Order updating implemented
- Order tracking supported
- Checkout workflow fully functional
- Basket/cart system fully working
- Backend integrated with frontend product and order pages
- Meets all MVP backend requirements

---
