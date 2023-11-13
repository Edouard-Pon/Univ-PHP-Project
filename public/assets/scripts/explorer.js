function validateSearch() {
    var searchInput = document.getElementById('search');
    if (searchInput.value.trim() === '') {
        alert('Please enter a search query.');
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}