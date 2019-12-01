cd C:/Users/alarin/Desktop/widgets
git checkout -b $1_automerge 
git add .
git commit -m"$1_automerge"
git push origin $1_automerge
sleep 10s