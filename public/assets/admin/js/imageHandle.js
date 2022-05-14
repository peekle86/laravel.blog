document.getElementById('post-form').addEventListener('submit', formSubmit);

function formSubmit(e) {
    e.preventDefault(); // before submitting form

    let bodyInput = document.getElementById('body');
    // insert body content from div to text-area
    bodyInput.value = document.getElementById('body-edit').innerHTML;

    e.target.submit(); // and only then submit the form
}

function search_image(button) {
    let container = document.getElementById('founded-img'),
        ignorePhoto = container.querySelector('img');

    // if the button is pressed while the image was received and viewed
    // so in the future we ignore that photo
    if (ignorePhoto) {
        ignorePhoto = ignorePhoto.dataset.id
    }

    $.ajax({
        type: 'POST',
        url: button.dataset.url,
        data: {
            _token: button.dataset.token, // csrf
            q: document.getElementById('title').value, // query
            ignore: ignorePhoto
        },
        beforeSend: function() { // on processing query
            let spinner = '<span class="spinner-border spinner-border-sm" role="status"></span> '; // make a spinner
            button.innerHTML = spinner + button.innerText; // and let that spinner spin inside button
            button.classList.add('disabled') // button set as disabled
        },
        success: function (data) { // on success response from server
            if (!data) { // if response is empty
                error('There are no results by that title')
            } else if (data.hasOwnProperty('error')) { // if response have an error
                error(data.message)
            } else { // else its doing well
                render_photo(data) // render a photo
            }
        },
        complete: function () { // on processing finish
            button.classList.remove('disabled'); // return button to working condition
            button.querySelector('span.spinner-border').remove() // and remove this spinner
        }
    })
}

// throws out an alert with error message
function error(message) {
    let container = document.getElementById('founded-img'),
        alert = document.createElement('div');
    alert.classList.add('alert', 'alert-danger');
    alert.innerText = message;
    container.innerHTML = '';
    container.append(alert)
}


function render_photo(photo) {
    let container = document.getElementById('founded-img'),
        img = document.createElement('img'); // so create img tag
    img.src = photo.webformatURL; // set up img src to received photo
    img.dataset.id = photo.id; // set up photo id as dataset id attribute
    img.classList = 'img-thumbnail'; // set some style
    container.innerHTML = ''; // clear up container
    container.append(img); // and append img tag to container

    let insertButton = document.createElement('button'); // create insert photo button
    insertButton.type = 'button';
    insertButton.classList.add('btn', 'btn-outline-success');
    insertButton.addEventListener('click', insert_image);
    insertButton.innerText = 'Insert image';
    container.after(insertButton); // add button after container
}

// Inserting founded photo to body input
function insert_image(e) {
    let container = document.getElementById('founded-img'),
        img = container.querySelector('img').outerHTML,
        bodyEdit = document.getElementById('body-edit');

    bodyEdit.innerHTML = img + "<br>" + bodyEdit.innerHTML; // insert to body
    container.innerHTML = ''; // remove photo from preview
    e.target.remove() // remove insert button
}

