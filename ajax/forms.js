const formPOST = (event, id, agentPath)=> {
    event.preventDefault();
    let formData = new FormData(document.getElementById(id));
    fetch(agentPath, {
        method: "POST",
        body: formData
    }).then(response=>response.text()).then(data=>{
        console.log(data);
        if (data == "cookie_ok") {
            location.reload();
        }
        
    })
};

/* const formCommentOnPost = (e, id, agentPath, comment_user, post_user, post_id, time)=> {
    e.preventDefault();
    let formData = new FormData(document.getElementById(id));
    formData.append('comment_user', comment_user);
    formData.append('post_user', post_user);
    formData.append('post_id', post_id);
    formData.append('time', time);
    fetch(agentPath, {
        method: "POST",
        body: formData
    })
}; */

const passwrdConfirm = (id1, id2)=> {
    if (document.getElementById(id2).value != document.getElementById(id1).value) {
        document.getElementById(id2).classList.add('is-invalid');
    } else {
        document.getElementById(id2).classList.remove('is-invalid');
    }
};