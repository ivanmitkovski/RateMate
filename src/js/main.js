$(document).ready(function() {
    // Function to generate the certificate
    function generateCertificate(categoryIndex, categoryName, winnerData) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Add title and category
        doc.setFontSize(20);
        doc.text('Certificate of Achievement', 105, 20, null, null, 'center');

        doc.setFontSize(14);
        doc.text(`This is to certify that`, 105, 40, null, null, 'center');
        doc.text(winnerData.name, 105, 60, null, null, 'center');
        doc.text(`has been awarded for their excellence in the category:`, 105, 80, null, null, 'center');
        doc.text(categoryName, 105, 100, null, null, 'center');
        
        // Add date
        const date = new Date().toLocaleDateString();
        doc.text('Date: ' + date, 105, 120, null, null, 'center');

        // Save the certificate
        doc.save(`${categoryName}-Certificate.pdf`);
    }

    // Add event listeners for certificate buttons
    $(".generate-btn").on('click', function() {
        const categoryIndex = $(this).attr('id').split('-')[2];  // Extract category index from button id
        const categoryName = $(`#${categoryIndex}-card h3`).text();  // Get category name
        const winnerData = {
            name: $(`#first-place-${categoryIndex}`).text().split(' - ')[0], // Get winner name from the first place text
            jobTitle: $(`#first-place-${categoryIndex}`).text().split(' - ')[1], // Get winner job title
            rating: $(`#first-place-${categoryIndex}`).text().split(' - ')[2]  // Get winner rating
        };

        generateCertificate(categoryIndex, categoryName, winnerData);
    });
});
