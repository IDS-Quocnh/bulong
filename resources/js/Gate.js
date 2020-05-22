export default class Gate {
    constructor(user) {
        this.user = user;
    }

    userId() {
        if (!this.user) {
            return null;
        }
        return this.user.id;
    }

    canDelete(comment) {
        return this.user.id == comment.user_id;
    }

    canEdit(comment) {
        return this.user.id == comment.user_id;
    }

    isAdmin() {
        return this.user.type === 'admin';
    }

    isUser() {
        return this.user.type === 'user';
    }

    isAuthor() {
        return this.user.type === 'author';
    }

    isAdminOrAuthor() {
        if (this.user.type === 'admin' || this.user.type === 'author') {
            return true;
        }
    }
}
