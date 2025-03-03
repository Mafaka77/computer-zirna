import React from "react";
import {
    AppBar,
    Avatar,
    Container,
    Grid,
    Hidden,
    Icon,
    IconButton,
    Toolbar,
    Typography,
    withStyles
} from "@material-ui/core";


const styles = (theme) => ({
    toolbar: {
        display: 'flex',
        alignItems: 'center',
    },
    secondaryBar: {
        backgroundColor: theme.palette.common.white,
        minHeight: '80px',
        justifyContent: 'center',
        border: '0 none #ccc',
        borderBottom: `2px solid ${theme.palette.primary.main}`,
    },
    menuButton: {
        marginLeft: -theme.spacing(1),
    },
    iconButtonAvatar: {
        padding: 4,
    },
    searchBar: {
        height: 44,
        paddingLeft: 16,
        paddingRight: 16,
        width: 400,
        border: '1px solid #D5D5D5',
        borderRadius: 22,
        backgroundColor: '#FFFFFF'
    },
    loading: {
        position: 'absolute',
        top: 80,
        width: '100%',
    }

});

const Header=({handleDrawer,handleProfile,classes})=>{
    return(

        <AppBar
            component="div"
            className={classes.secondaryBar}
            color="primary"
            position="sticky"
            elevation={0}
        >
                <Toolbar className={classes.toolbar}>
                    <Container maxWidth={"lg"}>
                        <Grid container justify={"space-between"} alignItems="center" spacing={4}>
                            {/*<Grid item container={true} direction={"row"}>*/}
                            <Hidden mdDown={true}>
                                <Grid  style={{display: 'flex',cursor:'pointer'}} item={true}>
                                    <Typography variant={"h6"}>Mizoram Computer zirna</Typography>
                                </Grid>
                            </Hidden>
                            <Hidden mdUp={true}>
                                <IconButton onClick={handleDrawer}>
                                    <Icon color={"primary"}>menu</Icon>
                                </IconButton>
                            </Hidden>

                            <Grid item>
                                <div>
                                    <IconButton onClick={handleProfile} name={'notification'}>
                                        <Avatar variant={'circular'}>T</Avatar>
                                    </IconButton>
                                    {/*{logged && <IconButton name={'notification'} onClick={event => history.push("/csc/setting")}>*/}
                                    {/*    <Icon>settings</Icon>*/}
                                    {/*</IconButton>}*/}
                                </div>

                            </Grid>

                        </Grid>
                    </Container>

                </Toolbar>

            {/*{loading && <LinearProgress className={classes.loading} color={"primary"} variant={"indeterminate"}/>}*/}

        </AppBar>
    )
}

export default withStyles(styles)(Header);
