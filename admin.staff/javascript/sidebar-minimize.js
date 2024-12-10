function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const editFormContainer = document.querySelector('.edit-form-container');
    
    sidebar.classList.toggle('minimized');
    mainContent.classList.toggle('sidebar-minimized');
    editFormContainer.classList.toggle('sidebar-minimized');
}

function openEditForm(userType, userId) {
    // Your logic to populate the form
    document.querySelector('.edit-form-container').style.display = 'flex';
}

function closeEditForm() {
    document.querySelector('.edit-form-container').style.display = 'none';
}



