/**
 * 
 * @param {()=>{}} actions 
 */
export default function mount(actions = () => {}) {
    actions();
}