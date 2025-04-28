<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>📦 Product Management API</h1>

<p>A simple <strong>RESTful API</strong> built with <strong>Laravel</strong> to manage products in a basic e-commerce system.<br>
It provides full CRUD functionality, filtering, pagination, soft deletes, and follows clean project structure practices.</p>

<hr>

<h2>🛒 Product Model</h2>

<p>Each product in the system has the following fields:</p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Field</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>id</td>
            <td>Integer</td>
            <td>Auto-increment primary key</td>
        </tr>
        <tr>
            <td>name</td>
            <td>String</td>
            <td>Name of the product</td>
        </tr>
        <tr>
            <td>images</td>
            <td>Array</td>
            <td>Array of image URLs</td>
        </tr>
        <tr>
            <td>description</td>
            <td>Text</td>
            <td>Detailed description of the product</td>
        </tr>
        <tr>
            <td>price</td>
            <td>Decimal</td>
            <td>Product price (supports two decimal places)</td>
        </tr>
        <tr>
            <td>quantity</td>
            <td>Integer</td>
            <td>Available stock quantity</td>
        </tr>
        <tr>
            <td>status</td>
            <td>Enum</td>
            <td>Product status: Active or Inactive</td>
        </tr>
        <tr>
            <td>deleted_at</td>
            <td>Timestamp</td>
            <td>Used for soft deletes</td>
        </tr>
    </tbody>
</table>

<hr>

<h2>🚀 Features</h2>
<ul>
    <li>Create, update, view, and soft delete products</li>
    <li>List products with pagination (default 10 items per page)</li>
    <li>Filtering by name, status, minimum and maximum price</li>
    <li>Change product status (active/inactive)</li>
    <li>Soft deletes instead of permanent deletion</li>
    <li>Request validation with proper error handling</li>
    <li>API Resource classes for clean, consistent API responses</li>
    <li>Seeder to generate 10 fake products automatically</li>
    <li>Repository pattern for separating data handling logic (ProductRepository)</li>
    <li>Interface (ProductRepositoryInterface) to define the contract for data management</li>
</ul>


<hr>

<h2>📂 API Endpoints</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>POST</td>
            <td>/api/products</td>
            <td>Create a new product</td>
        </tr>
        <tr>
            <td>PUT</td>
            <td>/api/products/{id}</td>
            <td>Update an existing product</td>
        </tr>
        <tr>
            <td>DELETE</td>
            <td>/api/products/{id}</td>
            <td>Soft delete a product</td>
        </tr>
        <tr>
            <td>GET</td>
            <td>/api/products/{id}</td>
            <td>View a specific product</td>
        </tr>
        <tr>
            <td>GET</td>
            <td>/api/products</td>
            <td>List all products (supports filters and pagination)</td>
        </tr>
        <tr>
            <td>PATCH</td>
            <td>/api/products/{id}/status</td>
            <td>Change the product's status</td>
        </tr>
    </tbody>
</table>

<h3>🔎 Filtering options for listing products:</h3>
<ul>
    <li><strong>name</strong> — Search by product name</li>
    <li><strong>status</strong> — Filter by product status (Active or Inactive)</li>
    <li><strong>min_price</strong> — Minimum price filter</li>
    <li><strong>max_price</strong> — Maximum price filter</li>
</ul>

<p><strong>Example:</strong></p>
<pre><code>GET /api/products?status=Active&amp;min_price=100&amp;max_price=500&amp;name=chair</code></pre>

<hr>

<h2>🛠️ Project Structure Highlights</h2>
<ul>
    <li><code>app/Http/Controllers/Api/ProductController.php</code> — API endpoints</li>
    <li><code>app/Services/ProductService.php</code> — Business logic layer</li>
    <li><code>app/Http/Resources/ProductResource.php</code> — Format API responses</li>
    <li><code>database/migrations/</code> — Migration file for <code>products</code> table</li>
    <li><code>database/seeders/ProductSeeder.php</code> — Generates 10 fake products</li>
    <li><code>app/Repositories/ProductRepository.php</code> — Repository for product data management</li>
    <li><code>app/Interfaces/ProductRepositoryInterface.php</code> — Interface defining the contract for the product repository</li>
</ul>


<hr>

<h2>⚙️ How to Run the Project</h2>

<ol>
    <li><strong>Clone the Repository</strong>
        <pre><code>git clone https://github.com/ahmed29920/Intelligent-Solutions-Task.git
cd Intelligent-Solutions-Task</code></pre>
    </li>
<li><strong>Install Dependencies</strong>
        <pre><code>composer install</code></pre>
    </li>

<li><strong>Copy .env File</strong>
        <pre><code>cp .env.example .env</code></pre>
    </li>

<li><strong>Configure Database</strong>
        <p>Update <code>.env</code> file:</p>
        <pre><code>DB_CONNECTION=mysql

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password</code></pre>

</li>

<li><strong>Generate App Key</strong>
        <pre><code>php artisan key:generate</code></pre>
    </li>

<li><strong>Run Migrations and Seeders</strong>
        <pre><code>php artisan migrate</code></pre>
        <pre><code>php artisan db:seed --class=ProductSeeder</code></pre>
    </li>

<li><strong>Serve the Application</strong>
        <pre><code>php artisan serve</code></pre>
        <p>The API will be available at: <a href="http://127.0.0.1:8000" target="_blank">http://127.0.0.1:8000</a></p>
    </li>

<li><strong>Use API Tools</strong>
        <p>Use tools like <strong>Postman</strong> or <strong>cURL</strong> to test the endpoints.</p>
    </li>

</ol>

<hr>

<h2>📄 Notes</h2>

<ul>
    <li>All responses are formatted using Laravel's API Resource classes.</li>
    <li>Soft-deleted products are excluded from listings unless otherwise queried.</li>
    <li>Validation errors return structured JSON responses.</li>
    <li>Exception handling is properly implemented.</li>
</ul>

<hr>


<h2>📬 Contact</h2>

<p>If you face any issues or have suggestions, feel free to open an issue or contact the maintainer.</p>

</body>
</html>
