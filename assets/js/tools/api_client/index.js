import axios from 'axios';
import querystring from 'querystring';

function getAuthHeaders() {
    return 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1NzgwNjE3MDAsImV4cCI6MTU3ODA2NTMwMCwicm9sZXMiOlsiUk9MRV9VU0VSIl0sImVtYWlsIjoiZ2hyaWltQGZha2VtYWlsLmNvbSJ9.m5eAlGhDfSAvgRvN1ugkGw5QfMt0L5fs7l0q9xUfSiCgj8CutNqw7GHagAdtbAEm6C5HqEWYVesycZysBZgquhUFMLm1gHUzCCZN5VVRxDteJ3gVpF3pcuxzZvHMtueTMx0W_TxYq-C6KNiodw8Jd4Ao4m9W5GMb9mm3hicNXewsE3vwtFDdAq7IpOPiwrH7FjNDtqcf_UiKF3x2jflQxoD7J9zvDxL3o0-m1_0nVRfTuU_q_vmmdeDcVd9wyzxrFP3ArAgKBPtd_aYMslC9Vvmpc4WQPQUUhmKCHrLYIePBaRIHNUYWnZhur0txdxeLsSG7o5z-opl-BZ-dKGMrQpPcd6Iapm8krQU1DvIQvRrdUsrZZPaJzBRv-C193MItxIHZ5LMYQgw55j0o2saOvwSix1gkYiCQKawfImGvnrWz9uL0r4stwjbzbtS2s1GY_-eiT6hMhOe_kgMPrdkK-c2jo17xzRIRYeFT7VzfOPvvKiuPz6aJmScKu2C1YAvCnshprWWpOw7uI-Gd-uzFPf2Yrmec6wNn0NYmqcpoTbNnz-QAA5j1yrRSlj1iPT8ktV3rcXdKqyNssxU2hJid5Gs7gxQXuAxvN28DeOCZUP46YQoEMZdPJb1gwRSFfZHcrt6RX0ZXvyAiQ1CYvS0HO4PN31NnF-2DB6rJnRQ1NaY';
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
    return axios.get(buildUrl(url, params), { headers: { 'Authorization': getAuthHeaders() } });
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