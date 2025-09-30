# Order Demo API

A Symfony REST API for managing orders with Doctrine event logging.

## Setup

1. Install dependencies:
```bash
composer install
```

2. Configure database in `.env`:
```
DATABASE_URL="mysql://root:password@127.0.0.1:3306/order_demo"
```

3. Create database and run migrations:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

4. Start server:
```bash
symfony server:start
```

## API Endpoints

### Create Order
```bash
POST /orders
Content-Type: application/json

{
  "customerName": "Alice",
  "amount": 99.99
}
```

### List Orders
```bash
GET /orders
```

### Update Order
```bash
PUT /orders/{id}
Content-Type: application/json

{
  "customerName": "Bob",
  "amount": 75.00
}
```

### Delete Order
```bash
DELETE /orders/{id}
```

## Event Logging

Doctrine events are logged to `var/log/dev.log`:
- Order created: `Doctrine Trigger: Order created.`
- Order updated: `Doctrine Trigger: Order updated.`
- Order deleted: `Doctrine Trigger: Order deleted.`

## Architecture

- **Controller**: Handles HTTP requests
- **Handler**: Business logic coordination
- **Service**: Core business operations
- **Factory**: Entity creation
- **Repository**: Data access
- **EventListener**: Doctrine event logging