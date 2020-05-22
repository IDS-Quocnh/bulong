export const getCategories = ({ commit }) => {
    axios.get('/api/categories')
        .then((response) => {
            commit('SET_CATEGORIES', response.data);
        })
}

export const getLatestConfessions = ({ commit }) => {
    axios.get('/confessions')
        .then(({ data }) => {
            commit('SET_LATEST_CONFESSIONS', data.data);
        })
}

export const getTrendingConfessions = ({ commit }) => {
    axios.get('/trending-confessions')
        .then(({ data }) => {
            commit('SET_TRENDING_CONFESSIONS', data.data);
        })
}

export const deleteConfession = ({ commit }, id) => {
    axios.delete(`/confessions/${id}`)
        .then(() => {
            console.log(id)
            commit('DELETE_CONFESSION', id)
            Vue.$toast.open('Confession deleted successfully')
        })
}

export const setActiveMenu = ({ commit }, activeMenu) => {
    commit('SET_ACTIVE_MENU', activeMenu);
}

export const getFollowingPeopleConfessions = ({ commit }) => {
    axios.get('/following-people-confessions')
        .then(({ data }) => {
            commit('SET_FOLLOWING_PEOPLE_CONFESSION', data.data);
        })
}

export const getFollowers = ({ commit }) => {
    axios.get('/followers')
        .then(({ data }) => {
            commit('SET_FOLLOWERS', data);
        })
}


export const followUser = ({ commit }, confession) => {
    axios.post('/follow-user', {
            id: confession.user.id
        })
        .then(() => {
            Fire.$emit('updated')
        })
}
