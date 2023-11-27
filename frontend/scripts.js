function loadSection(sectionName) 
{
    const contentSection = document.getElementById('content-section');

    // Clear existing content
    contentSection.innerHTML = '';

    // Load the selected section dynamically
    switch (sectionName) 
    {
        case 'explore':
            contentSection.innerHTML = '<h2>Explore Books</h2><p>Content for Explore section goes here.</p>';
            break;

        case 'marketplace':
            contentSection.innerHTML = '<h2>Book Marketplace</h2><p>Content for Marketplace section goes here.</p>';
            break;

        case 'create-account':
            contentSection.innerHTML = '<h2>Create Your Account</h2><p>Content for Create Account section goes here.</p>';
            break;
        case 'shelf':
            contentSection.innerHTML = '<h2>Your Book Shelf</h2><p>Content to add more books here.</p>';
            break;

        // Add more cases for additional sections

        default:
            break;
    }
}
