cd $1
git checkout -b $2_$3 
git add .
git commit -m"$2_$3"
git config --global user.email $4
git config --global user.name $5
git push origin $2_$3
read -p "Press enter to continue"