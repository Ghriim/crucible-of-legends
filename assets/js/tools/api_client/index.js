import axios from 'axios';
import querystring from 'querystring';
import store from '@tools/store';


function getAuthHeaders() {
    return 'Bearer ' + store.state.token;
}

function handleCommonApiError(response) {
    if (401 === response.status) {
        store.commit('logoutUser');
    }

    if (403 === response.status) {
        window.alert('With great powers come great responsibilities ! (You do not have the rights to realize this action)');
    }

    if (500 <= response.status && 600 > response.status) {
        window.alert('Error 5**. What to do ?');
    }
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
            handleCommonApiError(error.response);
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