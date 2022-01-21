module.exports = {
    methods: {

        asset(path) {
            var base_path = window._asset || '';
            return base_path + path;
        },
        url(path) {
            var base_path = window._url || '';
            return base_path + path;
        },
        backpack_url(path) {
            var base_path = window._backpack_url || '';
            return base_path + path;
        },
        rand(){
            return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        },
        rand2() {
            return (Math.random() + 1).toString(36).substring(7);
        },
        axiosURL(url){
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
            return (window._backpack_url || '') + '/' + url
        }

    }
}
