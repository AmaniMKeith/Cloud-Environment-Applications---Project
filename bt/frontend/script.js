$(document).ready(function() {
    fetchTransactions(); // Fetch initial transactions
  
    $('#transactionForm').submit(function(e) {
      e.preventDefault();
  
      const description = $('#description').val();
      const amount = $('#amount').val();
      const type = $('#type').val();
  
      $.ajax({
        type: 'POST',
        url: 'http://localhost:8080/transactions.php', 
        data: { description, amount, type },
        success: function(response) {
            console.log('Transaction added successfully:', response); // Log the response for debugging
            fetchTransactions(); // Update table 
            $('#transactionForm')[0].reset(); // Clear form
          },
          error: function(xhr, status, error) {
            console.error('Error adding transaction:', error); // Log any errors
          }
      });
    });
  
    function deleteTransaction(id) {
       $.ajax({
        type: 'DELETE',
        url: 'http://localhost:8080/transactions.php/' + id,
        success: function() {
          fetchTransactions(); 
        }
      });
    }
  
    function fetchTransactions() {
       $.getJSON('http://localhost:8080/transactions.php', function(data) {
          $('#transactionsTableBody').empty(); 
          $.each(data, function(index, transaction) {
            let row = `<tr>
                         <td>${transaction.description}</td>
                         <td>${transaction.amount}</td>
                         <td class="${transaction.type}">${transaction.type}</td>
                         <td><button onclick="deleteTransaction(${transaction.id})" class="btn btn-danger">Delete</button></td>
                       </tr>`;
            $('#transactionsTableBody').append(row);
          });
       });
    }
  });
  