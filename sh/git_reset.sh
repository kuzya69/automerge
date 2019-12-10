cd C:/Users/alarin/Desktop/widgets
git checkout master
git reset --hard
git clean -f -d
git branch -D $1_automerge
git push origin --delete $1_automerge
read -p "Press enter to continue"