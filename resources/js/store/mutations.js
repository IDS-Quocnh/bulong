export const SET_CATEGORIES = (state, categories) => {
    state.categories = categories;
}

export const SET_LATEST_CONFESSIONS = (state, latestConfessions) => {
    state.latestConfessions = latestConfessions;
}

export const SET_TRENDING_CONFESSIONS = (state, trendingConfessions) => {
    state.trendingConfessions = trendingConfessions;
}

export const DELETE_CONFESSION = (state, id) => {
    const index = state.latestConfessions.findIndex(confession => confession.id == id)
    state.latestConfessions.splice(index, 1)
    state.trendingConfessions.splice(index, 1)
    state.followingPeopleConfessions.splice(index, 1)
    // this.$modal.hide('dialog')
    // Vue.$toast.open('Confession deleted successfully')
    // Fire.$emit('ConfessionDeleted')
}


export const SET_FOLLOWING_PEOPLE_CONFESSION = (state, followingPeopleConfessions) => {
    state.followingPeopleConfessions = followingPeopleConfessions;
}

export const SET_ACTIVE_MENU = (state, activeMenu) => {
    state.activeMenu = activeMenu;
}

export const SET_FOLLOWINGS = (state, followings) => {
    state.followings = followings;
}

export const SET_FOLLOWERS = (state, followers) => {
    state.followers = followers;
}
