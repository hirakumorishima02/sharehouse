    var cmds = document.getElementsByClassName('del');
    var i;
    
    for (i=0; i < cmds.length; i++) {
        cmds[i].addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('本当に削除しますか?')) {
                document.getElementById('form_' + this.dataset.id).submit();
            }
        });
    }
    
    
    function countLength( text, field ) {
        document.getElementById(field).innerHTML = text.length;
      }
    