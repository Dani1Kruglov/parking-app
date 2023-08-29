<h1>Car Park Customer Management System on Laravel</h1>

<h2>Task Description</h2>

<p>This project is a car park customer management system implemented using the Laravel framework. The system has the following functionality:</p>

<ul>
    <li>Creating, editing, and deleting customer and vehicle data.</li>
    <li>Keeping track of the number and composition of vehicles in the car park.</li>
    <li>Protection against XSS attacks and SQL injections.</li>
</ul>

<h2>Main Entities</h2>

<h3>Customer</h3>
<ul>
    <li><strong>Full Name:</strong> Minimum 3 characters</li>
    <li><strong>Gender:</strong> Mandatory</li>
    <li><strong>Phone Number:</strong> Mandatory and unique</li>
    <li><strong>Address</strong></li>
    <li><strong>Vehicle(s):</strong> Mandatory, at least 1</li>
</ul>

<h3>Vehicle</h3>
<ul>
    <li><strong>Make:</strong> Mandatory</li>
    <li><strong>Model:</strong> Mandatory</li>
    <li><strong>Body Color:</strong> Mandatory</li>
    <li><strong>Russian License Plate Number:</strong> Mandatory and unique</li>
    <li><strong>Vehicle Status:</strong> Mandatory, indicates whether the vehicle is on the car park</li>
</ul>

<h2>Required Pages</h2>

<h3>View All Customers and Their Vehicles:</h3>
<ul>
    <li>With pagination</li>
    <li>Links to edit customer data and buttons to delete corresponding entities</li>
</ul>

<h3>Create Customer and Vehicle Data Page:</h3>
<p>Form for entering customer data and their vehicles</p>

<h3>Edit Customer and Vehicle Data Page:</h3>
<p>Form for editing customer data and their vehicles</p>

<h3>View All Vehicles in the Car Park Page:</h3>
<ul>
    <li>Form for entering an existing customer in the car park</li>
    <li>Two dropdown lists: the first one for customers and the second one for vehicles of the selected customer</li>
    <li>Buttons to change the vehicle status</li>
</ul>

<h2>Technical Requirements</h2>

<ul>
    <li>PHP 5.6 and above</li>
    <li>MySQL 5.6 and above</li>
    <li>Frameworks allowed: Codeigniter or Laravel (latest stable versions). If Laravel is used, all database queries should be written using QueryBuilder or Raw Query (i.e., without Eloquent ORM methods).</li>
    <li>The web interface can be designed using Bootstrap.</li>
</ul>
<h2>Name - Kruglov Danil</h2>
<h2>
GitHub: @Dani1Kruglov
</h2>

