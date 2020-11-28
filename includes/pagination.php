<?php 
    //define num of result per page
    $results_per_page = 12;
    
    $sql_query = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql_query);
    $number_of_results = mysqli_num_rows($result);
    
    
    //find number of total pages needed
    $number_of_pages = ceil($number_of_results / $results_per_page);
    
    //find which page number visitor is on
    if (!isset($_GET['page'])) {
        $page = 1;
    }
    else {
        $page = $_GET['page'];
    }
        
    //find sql limit starting num for results of products
    $this_page_first_result = ($page-1) * $results_per_page;
    
    //retrieve selected product results from db
    $sql_query = "SELECT * FROM products LIMIT " . $this_page_first_result  . ',' . $results_per_page;
    $result = mysqli_query($conn, $sql_query);
    
    while ($row = mysqli_fetch_array($result)) { 
        echo '<div class="col-md">';
        echo '<img src="' . $row['imageURL'] . '">'; 
        echo '<p>' . $row['name_desc'] . '<br>' . $row['price'] . ' ' . $row['currency'] . '<br> <p>'; 
        echo '</div>';
    }
    
    echo '</div>';
    
    //display links to the pages
    for ($page=1; $page <= $number_of_pages; ++$page) {
        echo '<a href="products.php?page=' . $page . '">' . $page . '</a> ';
    }
?>