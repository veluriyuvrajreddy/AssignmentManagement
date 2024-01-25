window.addEventListener('load', function (event) {
    
    document.getElementById("add_assignment").onclick = () => {
        if (document.getElementById("assignment_name").value.length === 0) alert("please fill first");
        else {
            const data = 
            {
                assignment_name: document.getElementById("assignment_name").value
            };
            fetch("all.php?task=assignment_name", {
                    method: "POST",
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.text())
                .then(res => {
                    if (res == "done") {
                        document.getElementById("assignment_name").value = "";
                        load_assignments();
                    } else {
                        console.log(res);
                    }
                });
        }
    }

    const is_active = (val) => {
        if (val === "false") return `<span style='float:left;color:red;font-size:20px'><b>&#x2717</b></span>`;
        else return `<span style='float:left;color:green;font-size:20px'><b>&#10003</b></span>`;
    }

const colors = ["red","blue","violet","skyblue","pink","green","yellow"];
    const load_assignments = () => {
        fetch("all.php?task=assignments")
            .then(res => res.json())
            .then(
                res => {
                    let data = "";
                    let i = 0;
                    let delete_options = '<option value="start">Select Assignment Name</option>';
                    let is_active_options = '<option value="start">Select Assignment Name</option>';
                    res.forEach(x => {
                        is_active_options += `<option value="${x[2]}">${x[2]}</option>`;
                        delete_options += `<option value="${x[2]}">${x[2]}</option>`;
                        data += `
                        <div class="col-sm-4">
                <div class="card">
                    <div
                        style="border-top:4px solid ${colors[i%colors.length]};border-bottom:1px solid rgba(0,0,0,0.3);padding:10px;text-align:center">
                        ${is_active(x[3])}
                        <span>${x[2]}</span>
                    </div>
                    <div style="margin-top:10px;padding:10px;">
                        <input type="text" class="form-control" value="https://assignmentmanagement.infinityfreeapp.com/upload.php?security_key=JFJYhgcdydHJV56486456GHTDTRfdtrdrft54874NBVGHCGC5484545&subject=${x[1]}&user=${x[5]}&assignment_name=${x[2]}" disabled>
                        <br>
                        <center><a href="https://assignmentmanagement.infinityfreeapp.com/assignment_results.php?security_key=JFJYhgcdydHJV56486456GHTDTRfdtrdrft54874NBVGHCGC5484545&subject=${x[1]}&user=${x[5]}&assignment_name=${x[2]}" target="_blank" >All Assignments</a></center>
                    </div>
                </div>
            </div>
`;
i+=1;
                    })
                    document.getElementById("all_assignments").innerHTML = data;
                    document.getElementById("is_active").innerHTML = is_active_options;
                    document.getElementById("to_delete").innerHTML = delete_options;
                }
            )
    }
    load_assignments();



    document.getElementById("is_active_update").onclick = () => {
        if (document.getElementById("is_active").value === "start") return;
        else {
            const data = {
                assignment_name: document.getElementById("is_active").value
            };
            fetch("all.php?task=is_active", {
                    method: "POST",
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.text())
                .then(res => {
                    if (res == "done") {
                        load_assignments();
                    } else {
                        console.log(res);
                    }
                });
        }
    }

// deleting files
    document.getElementById("delete_update").onclick = () => {
        
        if (document.getElementById("to_delete").value === "start") return;
        else {
            const data = {
                delete_assignment: document.getElementById("to_delete").value
            };
            fetch("all.php?task=delete", {
                    method: "POST",
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.text())
                .then(res => {
                    if (res == "done") {
                        
                        load_assignments();
                    } else {
                        console.log(res);
                    }
                });
        }
    }


})