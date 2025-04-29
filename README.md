<h1>Incodeks Code Challenge</h1>

<p>This repository contains the solution for the Incodeks code challenge.</p>

<h2>Setup Instructions</h2>

<p>Follow these steps to run the project locally:</p>

<ol>
  <li><strong>Clone the repository</strong>
    <pre><code>git clone https://github.com/alt1nn/incodeks.git</code></pre>
  </li>
  
  <li><strong>Navigate to the project folder</strong>
    <pre><code>cd incodeks</code></pre>
  </li>
  
  <li><strong>Install PHP dependencies</strong>
    <pre><code>composer install</code></pre>
  </li>
  
  <li><strong>Set up your environment</strong>
    <ul>
      <li>Create a <code>.env</code> file:
        <pre><code>cp .env.example .env</code></pre>
      </li>
      <li>Configure your database and other environment variables inside the <code>.env</code> file.</li>
    </ul>
  </li>
  
  <li><strong>Generate application key</strong>
    <pre><code>php artisan key:generate</code></pre>
  </li>
  
  <li><strong>Run migrations and seeders</strong>
    <pre><code>php artisan migrate --seed</code></pre>
  </li>
  
  <li><strong>Start the local server</strong>
    <pre><code>php artisan serve</code></pre>
  </li>
</ol>

<h2>Postman Collection</h2>

<p>You can test the API endpoints using the following Postman collection:</p>
<p><a href="https://lively-resonance-405016.postman.co/workspace/altini~7bb3719c-f9cc-4bf5-b90c-fc088b459993/collection/26629119-ff3d5ba6-0662-4cc5-8249-d661cc64da80?action=share&creator=26629119" target="_blank">Click here to view Postman Collection</a></p>

<h2>Seeder Information</h2>

<p>The seeder creates sample data for:</p>
<ul>
  <li><strong>Users:</strong> Admin and regular user accounts</li>
  <li><strong>Venues:</strong> Two sample venues</li>
  <li><strong>Events:</strong> Two events linked to users and venues</li>
  <li><strong>Tickets:</strong> Two tickets booked by the regular user</li>
</ul>

<p>After running <code>php artisan migrate --seed</code>, you will have initial data available to test the API endpoints immediately.</p>

<blockquote><strong>Note:</strong> The current implementation supports creating resources but does not include updating or deleting functionality.</blockquote>
