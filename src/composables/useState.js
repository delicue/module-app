export default function useState(initialValue) {
    let value = initialValue;

    function get() {
        return value;
    }

    function set(newValue) {
        value = newValue;
    }

    return [get, set];
}