cd $1
git checkout -b $2_automerge 
git add .
git commit -m"$2_automerge"
git config --global user.email $3
git config --global user.name $4
git push origin $2_automerge
sleep 10s