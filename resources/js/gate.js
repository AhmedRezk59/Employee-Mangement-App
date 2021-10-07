export default class Gate {
    constructor(user) {
        this.user = user
    }
    

    permissions() {
        return this.user.permissions
    }
    isAdmin() {
        return this.user.role.includes('Admin')
    }
    
    can(permissionName) {
        if (this.permissions().includes(permissionName)) {
            return true
        }
        return false;
    }
    
}