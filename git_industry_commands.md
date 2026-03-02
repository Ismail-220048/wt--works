<h4>1. Git Configuration Commands</h4>
  
  • **git config --global user.name**
        -Sets the global username for all Git commits on the system.
        SYNTAX:-
              git config --global user.name Ismail-220048
              
              <img width="394" height="44" alt="p1" src="https://github.com/user-attachments/assets/675c5ba9-381a-41ed-8f94-ca218adf4ec1" />

              
  • **git config --global user.email**
  
      -Sets the global usermail for all git commits on the system
      SYNTAX;-
            git config --global user.email n22********@gmail.com
            <img width="463" height="45" alt="p2" src="https://github.com/user-attachments/assets/c18a0085-3a7d-4e3b-a342-fef86b5e2b9b" />

  • **git config --list**
          -Displays all Git configuration settings currently active.
              
              It shows combined settings from:
              
              System level
              
              Global level
              Local (repository) level
              <img width="567" height="172" alt="p5" src="https://github.com/user-attachments/assets/1d73c22e-74f7-49f5-9464-e3d3cf296f3f"/>



  • **git config --unset**
        synta:-
            git config --unset <key>
        example
            git config --global --unset user.email
            <img width="399" height="206" alt="p4" src="https://github.com/user-attachments/assets/151e60a1-9d27-4fc0-be5a-0bd51653d356" />

<h4>2. Repository Setup Commands</h4>
**• git init**
        -Initializes a new Git repository in the current directory.

          It creates a hidden folder called:
                                          .git
          
          This .git folder stores:
          Commit history
          Branch information
          Configuration
          Staging area data
          Without .git, Git cannot track your project.
          <img width="707" height="70" alt="p7" src="https://github.com/user-attachments/assets/c2c4aa5d-6f31-43e6-a0c6-d1a14df71c95" />

 **• git clone**
      -syn:-
          git clone <repository-url>
      _-Creates a local copy of an existing remote repository (usually from GitHub)._
      <img width="661" height="167" alt="p8" src="https://github.com/user-attachments/assets/ca1493c0-43e7-40a3-8b5f-65710acb0197" />

**• git clone --branch**
       _ -Clones a specific branch from a remote repository instead of the default branch_
       SYN:-
           git clone --branch <branch-name> <repository-url>

           <img width="716" height="135" alt="p9" src="https://github.com/user-attachments/assets/86e5e42e-fbce-40d4-aecc-e3f0402f1346" />

**• git clone --depth**
       it downloads only a limited number of commits instead of the full history.
       SYNTAX:-
           git clone --depth <number> <repository-url>
      EXAMPLE:-
      <img width="612" height="133" alt="p10" src="https://github.com/user-attachments/assets/e464a7e7-7fc1-4e22-8343-7ae69cc0954e" />

<h4>3. Repository Status & Inspection</h4>
**. git status**
      -Displays the current state of the working directory and staging area.
          It tells you:
                Which branch you are on
                Modified files
                Staged files
                Untracked files
                If your branch is ahead/behind remote
     <img width="674" height="191" alt="p11" src="https://github.com/user-attachments/assets/7b50616d-f286-4e0f-bb2f-a8ed2f4110ce" />     

**• git log**
    -Displays the commit history of the repository.
    <img width="873" height="136" alt="p12" src="https://github.com/user-attachments/assets/16769329-8244-445f-8f0b-a141352a53a1" />

**• git log --oneline**
     - Displays commit history in a short, compact format — one commit per line.
     <img width="702" height="67" alt="p13" src="https://github.com/user-attachments/assets/be8598f9-80d9-457d-8f5c-3354a4223954" />

**• git log --graph**
      - Displays the commit history with a visual ASCII graph showing branch and merge structure.
      <img width="861" height="137" alt="p14" src="https://github.com/user-attachments/assets/3057a2d8-27e5-4a62-91c5-ce368c756bde" />

**• git show**
      -This shows details of the most recent commit.
      <img width="869" height="263" alt="p15" src="https://github.com/user-attachments/assets/16080a6d-ba76-48d4-b8f5-b917d11c5ad8" />

**• git diff**
      Shows the difference between:
      Working directory
      Last committed version
      <img width="595" height="191" alt="p16" src="https://github.com/user-attachments/assets/64ee8c1a-5ced-4940-ae7f-e0f51b9446fd" />

      
**• git diff --staged**
       Shows differences between:
        
        Staging area
        
        Last commit
        <img width="569" height="402" alt="p17" src="https://github.com/user-attachments/assets/a4751de4-0413-4bdf-95bf-e76634a208b1" />

**• git blame**
      -Shows who last modified each line of a file.
          Very useful for debugging and accountability
      SYNTAX:-
      _git blame <file-name>_
      
      <img width="606" height="64" alt="P18" src="https://github.com/user-attachments/assets/1fc882a0-3f6f-468d-afa5-0871c4682bcf" />

**• git reflog**
        -Shows history of all HEAD movements.
        -Even deleted commits can be recovered using reflog.
        <img width="978" height="103" alt="p19" src="https://github.com/user-attachments/assets/d6bdde44-c81f-4445-975c-70a7c18b1013" />


**• git shortlog**
      Summarizes commits grouped by author.
      <img width="427" height="78" alt="p20" src="https://github.com/user-attachments/assets/9713a261-335b-478c-89ff-c94e9e458c38" />
