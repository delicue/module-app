export default function render(template = '') {
    return template.replace(/<([A-Z][A-Za-z0-9]*)\s*\/>/g, (match, tag) => {
        //use special tags as a function
        return eval(tag)();
    });
}