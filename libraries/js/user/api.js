export default class UserConsumeAPI {
    constructor(){
        super();
    }
    getBankBranches(bankFetchBranchesKey){
        let branchSelector = document.getElementById("bank_branch"),
        awaitAnime = document.getElementById("loader-wrapper-2"),
        res,
        i,
        opt;
        $.ajax({
            type: "POST",
            url: "./middleware/user/handlePay/hndl_fetch_bank_branches",
            data:{'bankFetchBranchesKey':bankFetchBranchesKey},
            async: true,
            beforeSend:function(){
                awaitAnime.style.display='block';

            },
            success: function(data){
                console.log(data);
                res = JSON.parse(data);
                if(res['status']==='success'){
                    for (i =0;i<res['data'].length;i++) {
                        opt = document.createElement('option');
                        opt.value = res['data'][i].id;
                        opt.innerHTML = res['data'][i].branch_name;
                        branchSelector.appendChild(opt);
                    }
                }else {
                    getBankBranches(bankFetchBranchesKey);
                }
            },
            complete: function(){
                awaitAnime.style.display='none';

            },
            error: function(err){
                getBankBranches(bankFetchBranchesKey);
            }   
        });
    }
}

