document.addEventListener('DOMContentLoaded', () => {
    // Confirmation for delete action
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!confirm('Are you sure you want to delete this FAQ?')) {
                event.preventDefault();
            }
        });
    });

    // Show update form with pre-filled values
    document.querySelectorAll('.update-button').forEach(button => {
        button.addEventListener('click', () => {
            const question = button.getAttribute('data-question');
            const answer = button.getAttribute('data-answer');
            document.getElementById('new_question').value = question;
            document.getElementById('new_answer').value = answer;
            document.getElementById('updateForm').style.display = 'block';
        });
    });
});