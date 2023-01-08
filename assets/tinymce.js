import tinymce from 'tinymce';

const tinymceOptions = {
    selector: 'textarea',
    content_style: "body { font-family: monospace; }",
    content_css: '/build/app.css',
    menubar: false,
    plugins: 'lists advlist',
    toolbar: 'bullist numlist '
};
tinymce.init(tinymceOptions);