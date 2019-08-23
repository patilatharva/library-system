function checkImage(imageSrc, good, bad) {
    var img = new Image();
    img.onload = good; 
    img.onerror = bad;
    img.src = imageSrc;
}

function getCoverImage(form, isbn) {
    var coverLink = "http://covers.openlibrary.org/b/isbn/" + isbn + "-L.jpg?default=false";
    // checks if openlibrary.org has the image
    checkImage(coverLink,
        function() {
            // change the cover image if the image exists
            $(".book-thumbnail").attr("src", coverLink);
            form.coverLink.value = coverLink;
        }, 
        function() { 
            // keep the current image if the image doesn't exist
        } 
    );
}

function getBookDetails(form) {

    // Query the book database by ISBN code.
    isbn = form.isbn.value; 
    isbn = isbn.replace(/-/g, '');		//removes '-' characters 

    if(isbn!="") {
        getCoverImage(form, isbn);


        var url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var results = JSON.parse(this.responseText);
                if (results.totalItems) {
                    // There will be only 1 book per ISBN
                    var book = results.items[0];
                    var title = (book["volumeInfo"]["title"]);
                    var authors = (book["volumeInfo"]["authors"]);

                    var publisher = (book["volumeInfo"]["publisher"]);
                    var publishedDate = new Date ((book["volumeInfo"]["publishedDate"]));
                    var description = (book["volumeInfo"]["description"]);
                    var pageCount = (book["volumeInfo"]["pageCount"]);
                    var categories = (book["volumeInfo"]["categories"]);
                

                    form.author.value = authors.join(", ");
                    form.title.value = title;
                    form.isbn.value = isbn;

                    form.publisher.value = publisher;
                    form.publishedDate.value = publishedDate.getFullYear();
                    form.description.value = description;
                    form.pageCount.value = pageCount;
                    form.categories.value = categories;
                }
            }
        };

        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}