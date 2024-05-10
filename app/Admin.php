<?php

require_once ("Main.php");

// Define a class named Admin, inheriting properties and methods from the Main class
class Admin extends Main
	{
	// Define a protected property to store the admin ID
	protected $id;

	// Constructor method
	public function __construct()
		{
		// Initialize the parent constructor
		// $this->id = $_SESSION['admin']; // Note: This line is commented out, perhaps for testing purposes
		parent::__construct();
		}

	// Method to perform Create, Update, Delete operations
	public function cud($res, array $args = [], $message)
		{
		try {
			// Prepare and execute the provided SQL query
			$stmt = $this->conn->prepare($res);
			$stmt->execute($args);

			// Set a success message in the session
			$_SESSION['success_message'] = "Successfully " . $message;
			return TRUE;
			} catch (PDOException $e) {
			// If an exception occurs, catch it and handle it gracefully
			echo $e->getMessage(); // Print the error message (consider logging instead of echoing)
			$_SESSION['error_message'] = "Sorry still not " . $message; // Set an error message in the session
			return FALSE;
			}
		}

	// Method to retrieve data from the database
	public function ret($stmt, array $args = [])
		{
		// Prepare and execute the provided SQL statement
		$stmt = $this->conn->prepare($stmt);
		$stmt->execute($args);
		return $stmt; // Return the executed statement
		}

	public function search($stmt, $q, $category)
		{
		$stmt = $this->conn->prepare($stmt);
		$stmt->bindParam(":q", $q);
		$stmt->bindParam(":category", $category);
		$stmt->execute();
		return $stmt;
		}
	}
?>