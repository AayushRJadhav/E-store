
<?php
require "db.php";

// Add or update a product
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    if ($action === "add" || $action === "update") {
        $name = trim($_POST["name"] ?? "");
        $price = $_POST["price"] ?? "";
        $quantity = $_POST["quantity"] ?? "";

        if (
            $name !== "" &&
            is_numeric($price) && $price >= 0 &&
            filter_var($quantity, FILTER_VALIDATE_INT) !== false &&
            $quantity >= 0
        ) {
            if ($action === "add") {
                $stmt = $pdo->prepare(
                    "INSERT INTO products (name, price, quantity)
                     VALUES (?, ?, ?)"
                );
                $stmt->execute([$name, $price, $quantity]);
            } else {
                $id = filter_var($_POST["id"] ?? "", FILTER_VALIDATE_INT);

                if ($id && $id > 0) {
                    $stmt = $pdo->prepare(
                        "UPDATE products
                         SET name = ?, price = ?, quantity = ?
                         WHERE id = ?"
                    );
                    $stmt->execute([$name, $price, $quantity, $id]);
                }
            }
        }
    }

    // Delete a product
    if ($action === "delete") {
        $id = filter_var($_POST["id"] ?? "", FILTER_VALIDATE_INT);

        if ($id && $id > 0) {
            $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);
        }
    }

    // Prevent resubmission when refreshing the page
    header("Location: products.php");
    exit;
}

// Load all products
$products = $pdo->query(
    "SELECT * FROM products ORDER BY id DESC"
)->fetchAll();

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Estore | Manage Products</title>

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    margin: 0;
    padding: 30px 16px;
    background: #e3e6f3;
    color: #222;
}

.container {
    max-width: 1000px;
    margin: auto;
    padding: 25px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,.08);
}

h1, h2 {
    color: #088178;
}

.form-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 10px;
    align-items: end;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    padding: 10px 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
    background: #088178;
}

button:hover {
    opacity: .85;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px 8px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

th {
    background: #088178;
    color: white;
}

.actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.delete {
    background: #c0392b;
}

.edit-form {
    min-width: 420px;
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr auto auto;
    gap: 6px;
}

.table-wrap {
    overflow-x: auto;
}

@media (max-width: 700px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .container {
        padding: 16px;
    }
}
</style>
</head>

<body>
<div class="container">
    <h1>Estore — Product Management</h1>
    <p>Add, view, update, or delete products in your database.</p>

    <h2>Add Product</h2>

    <form method="POST" action="products.php" class="form-grid">
        <input type="hidden" name="action" value="add">

        <div>
            <label for="name">Product Name</label>
            <input id="name" name="name" maxlength="100"
                   required>
        </div>

        <div>
            <label for="price">Price</label>
            <input id="price" name="price" type="number"
                   min="0" step="0.01" required>
        </div>

        <div>
            <label for="quantity">Quantity</label>
            <input id="quantity" name="quantity" type="number"
                   min="0" step="1" required>
        </div>

        <button type="submit">Add Product</button>
    </form>

    <h2>Product List</h2>

    <div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php if (!$products): ?>
            <tr>
                <td colspan="5">No products added yet.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= h($product["id"]) ?></td>
                <td><?= h($product["name"]) ?></td>
                <td>$<?= number_format((float)$product["price"], 2) ?></td>
                <td><?= h($product["quantity"]) ?></td>
                <td>
                    <div class="actions">
                        <button type="button"
                            onclick="document.getElementById('edit-<?= h($product['id']) ?>').hidden = false">
                            Edit
                        </button>

                        <form method="POST" action="products.php"
                              onsubmit="return confirm('Delete this product?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id"
                                   value="<?= h($product["id"]) ?>">
                            <button class="delete" type="submit">Delete</button>
                        </form>
                    </div>

                    <form id="edit-<?= h($product['id']) ?>"
                          class="edit-form"
                          method="POST"
                          action="products.php"
                          hidden>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id"
                               value="<?= h($product["id"]) ?>">

                        <input name="name" maxlength="100"
                               value="<?= h($product["name"]) ?>"
                               aria-label="Product name" required>

                        <input name="price" type="number" min="0"
                               step="0.01"
                               value="<?= h($product["price"]) ?>"
                               aria-label="Price" required>

                        <input name="quantity" type="number" min="0"
                               step="1"
                               value="<?= h($product["quantity"]) ?>"
                               aria-label="Quantity" required>

                        <button type="submit">Save</button>
                        <button type="button" class="delete"
                            onclick="this.form.hidden = true">Cancel</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>
