window.addEventListener('load', function (event)
 {
    
    document.getElementById("add_subject").onclick = () => {
        if (document.getElementById("subject_name").value.length === 0) alert("please fill first");
        else {
            const data = {
                subject_name: document.getElementById("subject_name").value
                
            };
            fetch("sub.php?task1=subject_name", {
                    method: "POST",
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.text())
                .then(res => {
                    if (res == "done") {
                        document.getElementById("subject_name").value = "";
                        load_subjects();
                    } else {
                        console.log(res);
                    }
                });
        }
    }

    

const colors = ["red","blue","violet","skyblue","pink","green","yellow"];
    const load_subjects = () => {
        fetch("sub.php?task1=subjects")
            .then(res => res.json())
            .then(
                res => {
                    let data = "";
                    let i = 0;
                    let delete_options = '<option value="start">Select Subject Name</option>';
                    res.forEach(x => {
                        delete_options += `<option value="${x[1]}">${x[1]}</option>`;
                        data += `
                        
                        <div class="col-sm-4">
                <div class="card">
                    <div
                        style="border-top:4px solid ${colors[i%colors.length]};border-bottom:1px solid rgba(0,0,0,0.3);padding:10px;text-align:center">
                        
                        <center><a href="https://assignmentmanagement.infinityfreeapp.com/home.php?sub_name=${x[1]}" target="_blank" >${x[1]}</a></center>
                       
                    </div>
                </div>
            </div>
            
`;
i+=1;
                    })
                    document.getElementById("all_subjects").innerHTML = data;
                    document.getElementById("to_delete_subject").innerHTML = delete_options;
                }
            )
    }
    load_subjects();


    document.getElementById("delete_subject").onclick = () => {
        if (document.getElementById("to_delete_subject").value === "start") return;
        else {
            const data = {
                delete_subject : document.getElementById("to_delete_subject").value
                
            };
            fetch("sub.php?task1=deletes", {
                    method: "POST",
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.text())
                .then(res => {
                    if (res == "done") {
                        load_subjects();
                    } else {
                        console.log(res);
                    }
                });
        }
    }


})