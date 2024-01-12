$(document).ready(function() {
    // Handle form submission
    $("#transactionForm").submit(function(event) {
        event.preventDefault();
        addTransaction();
        $("#transactionForm")[0].reset();
    });

    // Initial load of transactions and balance
    fetchTransactions();
    updateBalance();
});

// Function to add transaction
function addTransaction() {
    const category = $("#category").val();
    const amount = $("#amount").val();
    const type = $("#type").val();
    
    $.ajax({
        type: "POST",
        url: "api.php",
        data: {
            action: "addTransaction",
            category: category,
            amount: amount,
            type: type
        },
        success: function(response) {
            // Update the transaction list and balance
            fetchTransactions();
            updateBalance();
        }
    });
}

// Function to fetch transactions
function fetchTransactions() {
    $.ajax({
        type: "GET",
        url: "api.php",
        data: {
            action: "getTransactions"
        },
        success: function(response) {
            // Update the transaction list
            $("#transactionList").html(response);
        }
    });
}

// Function to update balance
function updateBalance() {
    $.ajax({
        type: "GET",
        url: "api.php",
        data: {
            action: "getBalance"
        },
        success: function(response) {
            // Update the balance
            $("#balance").text(response);
        }
    });
}
