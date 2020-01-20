import axios from 'axios';
import querystring from 'querystring';
import store from '@tools/store';


function getAuthHeaders() {
    return 'Bearer ' + store.state.token;
}

function urlEncodeParameters(parametersBag) {
    if (null === parametersBag) {
        return "";
    }

    let parameters = [];
    Object.keys(parametersBag).map(function(key) {
        let parameter = null;
        let value     = parametersBag[key];

        if (Array.isArray(parametersBag[key])) {
            parameter = value.join();
        } else {
            parameter = value;
        }

        if (undefined !== value && '' !== value) {
            parameters.push(key + "=" + parameter);
        }
    });

    return parameters.join('&')
}

function buildUrl(url, params) {
    let parameters = params ? "?" + urlEncodeParameters(params) : "";

    return url + parameters;
}

function getOne(url, id, params) {
    return axios.get(buildUrl(url, params) + '/' + id, { headers: { 'Authorization': getAuthHeaders() } });
}

function getMany(url, params) {
    return axios.get(buildUrl(url, params), { headers: { 'Authorization': getAuthHeaders() } })
        .catch(error => {
            if (401 === error.response.status) {
                store.commit('logoutUser');
            }
        });
}

function post(url, objectToPost) {
    return axios.post(
        url,
        querystring.stringify(objectToPost),
        {
            headers: {
                'Authorization': getAuthHeaders(),
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }
    );
}

function deleteOne(url, id) {
    return axios.delete(url + '/' + id, { headers: { 'Authorization': getAuthHeaders() } });
}

const ApiClient = {
    getOne, getMany, post, deleteOne
};

export default ApiClient;