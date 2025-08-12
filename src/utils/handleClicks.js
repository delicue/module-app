export default function handleClicks()
{
    document.body.addEventListener('click', function(event) {
        if (event.target.tagName === 'A') { // Check if the clicked element is a link
            console.log('Link clicked via delegation:', event.target.href);
            event.preventDefault();
            console.log('Click canceled');
        }
    });
}